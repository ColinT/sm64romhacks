document.addEventListener("DOMContentLoaded", main);

const DEBOUNCE_DELAY = 200;

/**
 * @typedef {Object} HackTableRowContent
 * @property {string} hackName
 * @property {string} authorName
 * @property {string} hackDate
 * @property {string} tag
 * @property {HTMLTableRowElement} tableRow
 */

/**
 * @typedef Hack
 * @property {string} name
 * @property {HackVersion[]} versions
 * @property {string} releaseDate
 * @property {string} tag
 */

/**
 * @typedef HackVersion
 * @property {string} versionName
 * @property {string[]} creators
 * @property {string} starCount // maybe this should be a number instead for sorting purposes
 * @property {string} fileName
 */

async function main() {

  const data = await getData();
  const templatePageContainer = document.querySelector("#template-page");
  templatePageContainer.innerHTML = getTemplatePageContent(data);

  const hacksTable = getHacksTable(data.patches, data.user);
  const hacksCollectionDiv = document.querySelector("#hacksCollection");
  const hacksDescriptionDiv = document.querySelector("#hacksDescription");

  hacksCollectionDiv.innerHTML += hacksTable;
  hacksDescriptionDiv.innerHTML = data.patches[0].hack_description;

  const allImages = data.images
  const hacksImagesContent = getHacksImagesContent(allImages);
  const hacksImagesDiv = document.querySelector("#hacksImages");
  hacksImagesDiv.innerHTML = hacksImagesContent;
}

/**
 * @returns {Hack[]}
 */
async function getData() {
  const urlName = window.location.pathname.split("/")[window.location.pathname.split("/").length - 1]
  try {
    const response = await fetch(`/api/hacks?hack_name=${getURLName(urlName)}`);
    if (!response.ok) {
        throw new Error(`${response.status} ${response.statusText}`);
    }
    const r = await response.json()
    return r;
  } 
  catch (error) {
      console.log(error);
  }
}

function getTemplatePageContent(data) {
  const hack_name = data.patches[0].hack_name;
  const options = data.user.admin ? `&nbsp;<a class="btn btn-danger text-nowrap" href="deleteHack.php?hack_name=${hack_name}"><img src="/_assets/_img/icons/delete.svg"></a>&nbsp;<a class="btn btn-info text-nowrap" href="editHack.php?hack_name=${hack_name}"><img src="/_assets/_img/icons/edit.svg"></a>` : `&nbsp;`;

  return `
    <h1><u>${hack_name}</u>${options}</h1>
    <div class="table-responsive" id="hacksCollection"></div>
						<div class="text-nowrap" id="hacksImages"></div>
				<br/>
				
                <div class="bg-dark text-left" id="hacksDescription"></div>
  `; 
}

/**
 * @param {Hack[]} hacks
 * @returns {string}
 */
function getHacksTable(hacks, user) {
  const headerRow = getHacksTableHeaderRow();
  const hackTableRows = hacks.map((hack) => getTableRowFromHack(hack, user)).join("");

  return `
    <table class="table-sm table-bordered">
      ${headerRow}
      ${hackTableRows}
    </table>
  `;
}

function getHacksImagesContent(images) {
  const imagesContent = images.map((image) => getImage(image)).join("")
  return imagesContent
}

function getImage(image) {
  return  `<img class=p-3 width=320 height=240 src="/_assets/_img/hacks/${image}">`
}

function getCreatorsMarkUp(creators, users) {
  const data = creators.split(', ');
  const userData = data.map((creator) => {
    const x = users.filter(e => e.discord_username === creator | e.twitch_handle === creator)
    return x.length != 0 ? `<a href="/users/${x[0].discord_id}" target="_blank">${creator}</a>` : creator
  }).join(", ")
  return userData
}

/**
 * @returns {string}
 */
function getHacksTableHeaderRow() {
  return `
    <tr>
      <th><b>Hack ID</b></th>
      <th><b>Hack Name</b></th>
      <th><b>Hack Version</b></th>
      <th><b>Download Link</b></th>
      <th><b>Creator</b></th>
      <th><b>Starcount</b></th>
      <th><b>Date</b></th>
      <th><b>Tag</b></th>
      <th class="border-0" colspan="3">&nbsp;</th>
    </tr>
  `;
}

/**
 * @param {Hack} hack
 * @returns {string}
 */
function getTableRowFromHack(hack, user) {
  const hackID = hack.hack_id;
  const hackName = hack.hack_name;
  const hackVersion = hack.hack_version;
  const hackDownloads = hack.hack_downloads;
  const hackCreator = hack.authors;
  const hackStarcount = hack.hack_starcount;
  const hackReleaseDate = hack.hack_release_date;
  const hackTags = hack.hack_tags; 
  const adminLoad = user.admin ? `<td class="border-0"><a class="btn btn-danger btn-block text-nowrap" href="deleteHack.php?hack_id=${hackID}"><img src="/_assets/_img/icons/delete.svg"></a></td><td class="border-0"><a class="btn btn-info btn-block text-nowrap" href="editHack.php?hack_id=${hackID}"><img src="/_assets/_img/icons/edit.svg"></a>` : `&nbsp;`
  const hackRecommend = hack.hack_recommend
  const recommendRow = hackRecommend == 1 ? `class=table-primary` : ``
  const creatorsMarkUp = getCreatorsMarkUp(hackCreator, user.users);


  return `
    <tr>
      <td ${recommendRow}>${hackID}</td>
      <td ${recommendRow}>${hackName}</td>
      <td ${recommendRow}>${hackVersion}</td>
      <td ${recommendRow}><a href="/hacks/download.php?hack_id=${hackID}">Download</a><br><span class="text-muted">Downloads: ${hackDownloads}</span></td>
      <td ${recommendRow}>${creatorsMarkUp}</td>
      <td ${recommendRow}>${hackStarcount}</td>
      <td ${recommendRow}>${hackReleaseDate}</td>
      <td ${recommendRow}>${hackTags}</td>
      <td class="border-0">${adminLoad}</td>
    </tr>
  `;
}

function getURLName(hackName)
{
  hackName = (hackName + '')
  hackName = hackName.replaceAll(':', '_');
  return encodeURIComponent(hackName)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/~/g, '%7E')
    .replace(/%20/g, '+')
  }

/**
 * @function debounce
 * @param {Function} callback function to invoke after calls have been debounced
 * @param {number} delay number of milliseconds of debounce delay
 * 
 * @returns {Function} modified function with debounce logic
 */
function debounce(callback, delay) {
  let timeout;

  return function debouncedFunction(...args) {
    const delayedFunction = () => {
      clearTimeout(timeout);
      callback(...args);
    };

    clearTimeout(timeout);
    timeout = setTimeout(delayedFunction, delay);
  };
}