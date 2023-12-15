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
  console.log(data)
  const hacksTable = getHacksTable(data.patches, data.admin);
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
  const response = await fetch(`/api?hack_name=${getURLName(urlName)}`); // relative to root
  const data = await response.json();
  return data;
}

/**
 * @param {Hack[]} hacks
 * @returns {string}
 */
function getHacksTable(hacks, adminCheck) {
  const headerRow = getHacksTableHeaderRow();
  const hackTableRows = hacks.map((hack) => getTableRowFromHack(hack, adminCheck)).join("");

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
function getTableRowFromHack(hack, adminCheck) {
  const hackID = hack.hack_id;
  const hackName = hack.hack_name;
  const hackVersion = hack.hack_version;
  const hackDownloads = hack.hack_downloads;
  const hackCreator = hack.authors;
  const hackStarcount = hack.hack_starcount;
  const hackReleaseDate = hack.hack_release_date;
  const hackTags = hack.hack_tags; 
  const adminLoad = adminCheck ? `<a class="btn btn-warning btn-block text-nowrap" href="/hacks/claim.php?hack_id=${hackID}"><img src="/_assets/_img/icons/claim.svg"></a></td><td class="border-0"><a class="btn btn-danger btn-block text-nowrap" href="deleteHack.php?hack_id=${hackID}"><img src="/_assets/_img/icons/delete.svg"></a></td><td class="border-0"><a class="btn btn-info btn-block text-nowrap" href="editHack.php?hack_id=${hackID}"><img src="/_assets/_img/icons/edit.svg"></a>` : `&nbsp;`
  const hackRecommend = hack.hack_recommend
  const recommendRow = hackRecommend == 1 ? `class=table-primary` : ``

  return `
    <tr>
      <td ${recommendRow}>${hackID}</td>
      <td ${recommendRow}>${hackName}</td>
      <td ${recommendRow}>${hackVersion}</td>
      <td ${recommendRow}><a href="/hacks/download.php?hack_id=${hackID}">Download</a><br><span class="text-muted">Downloads: ${hackDownloads}</span></td>
      <td ${recommendRow}>${hackCreator}</td>
      <td ${recommendRow}>${hackStarcount}</td>
      <td ${recommendRow}>${hackReleaseDate}</td>
      <td ${recommendRow}>${hackTags}</td>
      <td class="border-0">${adminLoad}</td>
    </tr>
  `;
}

function getURLName(hackName)
{
  hackName = hackName.replace(':', '_');
  let newStr = '';
  const len = hackName.length;

  for (let i = 0; i < len; i++) {
    let c = hackName.charAt(i);
    let code = hackName.charCodeAt(i);

    // Spaces
    if (c === ' ') {
      newStr += '+';
    }
    // Non-alphanumeric characters except "-", "_", and "."
    else if ((code < 48 && code !== 45 && code !== 46) ||
             (code < 65 && code > 57) ||
             (code > 90 && code < 97 && code !== 95) ||
             (code > 122)) {
      newStr += '%' + code.toString(16);
    }
    // Alphanumeric characters
    else {
      newStr += c;
    }
  }

  return newStr;
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