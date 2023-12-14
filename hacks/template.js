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
  const allHacks = await getAllHacks();
  const hacksTable = getHacksTable(allHacks);
  const hacksCollectionDiv = document.querySelector("#hacksCollection");
  hacksCollectionDiv.innerHTML += hacksTable;
}

/**
 * @returns {Hack[]}
 */
async function getAllHacks() {
  const urlName = window.location.pathname.split("/")[window.location.pathname.split("/").length - 1]
  const response = await fetch(`/api?hack_name=${urlName}`); // relative to root
  const data = await response.json();
  console.log(data)
  return data;
}

/**
 * @param {Hack[]} hacks
 * @returns {string}
 */
function getHacksTable(hacks) {
  const headerRow = getHacksTableHeaderRow();
  const hackTableRows = hacks.map((hack) => getTableRowFromHack(hack)).join("");

  return `
    <table class="table-sm table-bordered" id="myTable">
      ${headerRow}
      ${hackTableRows}
    </table>
  `;
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
    </tr>
  `;
}

/**
 * @param {Hack} hack
 * @returns {string}
 */
function getTableRowFromHack(hack) {
  const hackID = hack.hack_id;
  const hackName = hack.hack_name;
  const hackVersion = hack.hack_version;
  const hackPatchName = hack.hack_patchname;
  const hackDownloads = hack.hack_downloads;
  const hackCreator = hack.authors;
  const hackStarcount = hack.hack_starcount;
  const hackReleaseDate = hack.hack_release_date;
  const hackTags = hack.hack_tags; 

  // TODO: use the correct relative url path
  // Might need to add this to data.json or use single page app framework

  return `
    <tr>
      <td>${hackID}</td>
      <td>${hackName}</td>
      <td>${hackVersion}</td>
      <td><a href="/hacks/download.php?hack_id=${hackID}">Download</a><br><span class="text-muted">Downloads: ${hackDownloads}</span></td>
      <td>${hackCreator}</td>
      <td>${hackStarcount}</td>
      <td>${hackReleaseDate}</td>
      <td>${hackTags}</td>
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