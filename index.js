document.addEventListener("DOMContentLoaded", main);

const DEBOUNCE_DELAY = 200;

const HACK_NAME_COLUMN_INDEX = 0;
const AUTHOR_NAME_COLUMN_INDEX = 1;
const HACK_DATE_COLUMN_INDEX = 2;
const TAG_COLUMN_INDEX = 3;

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

/**
 * @typedef {"hackName" | "authorName" | "hackDate" | "tag"} SearchKey
 */

/**
 * @typedef {(tableRowContent: HackTableRowContent) => boolean} FilterPredicate
 */

async function main() {
  const allHacks = await getAllHacks();
  const hacksTable = getHacksTable(allHacks);
  const hacksCollectionDiv = document.querySelector("#hacksCollection");
  hacksCollectionDiv.innerHTML = hacksTable;
  const myTable = document.getElementById("myTable");
  //fillTable(allHacks);


  /** @type {HackTableRowContent[]} */
  const tableRowContents = Array.from(myTable.getElementsByTagName("tr")).slice(1).map((tableRow) => {
    const columns = tableRow.getElementsByTagName("td");
    return {
      hackName: columns[HACK_NAME_COLUMN_INDEX].innerText.toUpperCase(),
      authorName: columns[AUTHOR_NAME_COLUMN_INDEX].innerText.toUpperCase(),
      hackDate: columns[HACK_DATE_COLUMN_INDEX].innerText.toUpperCase(),
      tag: columns[TAG_COLUMN_INDEX].innerText.toUpperCase(),
      tableRow,
    }
  });

  const hackNamesInput = document.getElementById("hackNamesInput");
  setHackNamesFilterHandler(hackNamesInput, tableRowContents);

  const authorNamesInput = document.getElementById("authorNamesInput");
  setAuthorNamesFilterHandler(authorNamesInput, tableRowContents);

  const hackDatesInput = document.getElementById("hackDatesInput");
  setHackDatesFilterHandler(hackDatesInput, tableRowContents);

  const tagInput = document.getElementById("tagInput");
  setTagFilterHandler(tagInput, tableRowContents);
}

/**
 * @returns {Hack[]}
 */
 async function getAllHacks() {
  const response = await fetch("./_data/hacks.json"); // relative to root
  const data = await response.json();
  return data.hacks;
}

/**
 * @param {Hack[]} hacks
 * @returns {string}
 */
function getHacksTable(hacks) {
  const headerRow = getHacksTableHeaderRow();
  const hackTableRows = hacks.map((hack) => getTableRowFromHack(hack)).join("");

  return `
    <table id='myTable' border='1' align='center'>
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
      <th><b>Hackname</b></th>
      <th class="creator"><b>Creator</b></th>
      <th>Initial Release Date (yyyy-mm-dd)</th>
      <th hidden>Tag</th>
    </tr>
  `;
}

/**
 * @param {Hack} hack
 * @returns {string}
 */
function getTableRowFromHack(hack) {
  const hackName = hack.name;
  const hackCreators = getAllCreatorsOfHack(hack).join(', ');
  const releaseDate = hack.releaseDate;
  const tag = hack.tag;

  // TODO: use the correct relative url path
  // Might need to add this to data.json or use single page app framework

  return `
    <tr>
      <td><a href="hacks/${getURLName(hackName)}">${hackName}</a></td>
      <td>${hackCreators}</td>
      <td class="text-nowrap">${releaseDate}</td>
      <td hidden>${tag}</td>
    </tr>
  `;
}

function getURLName(hackName)
{
  //hackName = SubtleCrypto. How did this make it into here
  hackName = hackName.split(" ").join("_");
  hackName = hackName.split("(").join("_");
  hackName = hackName.split(")").join("_");
  hackName = hackName.split("'").join("");
  hackName = hackName.split(":").join("");
  hackName = hackName.split("/").join("");
  return hackName.toLowerCase();
}

/**
 * @param {Hack} hack
 * @returns {string[]}
 */
function getAllCreatorsOfHack(hack) {
  const creators = new Set();
  hack.versions.forEach((version) => {
    version.creators.forEach((versionCreator) => {
      creators.add(versionCreator);
    });
  });
  return Array.from(creators);
}

/**
 * @param {HTMLInputElement} hackNamesInput
 * @param {HackTableRowContent[]} tableRowContents
 */
function setHackNamesFilterHandler(hackNamesInput, tableRowContents) {
  hackNamesInput.addEventListener("keyup", debounce((keyUpEvent) => {
    const searchString = keyUpEvent.target.value.toUpperCase();
    filterRows(tableRowContents, isTableRowContentKeySubstring(searchString, "hackName"));
  }), DEBOUNCE_DELAY);
}

/**
 * @param {HTMLInputElement} authorNamesInput
 * @param {HackTableRowContent[]} tableRowContents
 */
function setAuthorNamesFilterHandler(authorNamesInput, tableRowContents) {
  authorNamesInput.addEventListener("keyup", debounce((keyUpEvent) => {
    const searchString = keyUpEvent.target.value.toUpperCase();
    filterRows(tableRowContents, isTableRowContentKeySubstring(searchString, "authorName"));
  }), DEBOUNCE_DELAY);
}

/**
 * @param {HTMLInputElement} hackDatesInput
 * @param {HackTableRowContent[]} tableRowContents
 */
function setHackDatesFilterHandler(hackDatesInput, tableRowContents) {
  hackDatesInput.addEventListener("keyup", debounce((keyUpEvent) => {
    const searchString = keyUpEvent.target.value.toUpperCase();
    filterRows(tableRowContents, isTableRowContentKeySubstring(searchString, "hackDate"));
  }), DEBOUNCE_DELAY);
}

/**
 * @param {HTMLSelectElement} tagInput
 * @param {HackTableRowContent[]} tableRowContents
 */
 function setTagFilterHandler(tagInput, tableRowContents) {
  tagInput.addEventListener("change", debounce((changeEvent) => {
    const searchString = changeEvent.target.value.toUpperCase();
    filterRows(tableRowContents, isTableRowContentKeyEqual(searchString, "tag"));
  }), DEBOUNCE_DELAY);
}

/**
 * @param {HackTableRowContent[]} tableRowContents
 * @param {FilterPredicate} predicate
 */
function filterRows(tableRowContents, predicate) {
  tableRowContents.forEach((tableRowContent) => {
    const tableRow = tableRowContent.tableRow;
    if (predicate(tableRowContent)) {
      showTableRow(tableRow);
    } else {
      hideTableRow(tableRow);
    }
  });
}

/**
 * @param {string} searchString
 * @param {SearchKey} keyName
 * @return {FilterPredicate}
 */
function isTableRowContentKeySubstring(searchString, keyName) {
  return (tableRowContent) => {
    if (searchString === "") {
      return true;
    }
    return tableRowContent[keyName].includes(searchString);
  }
}

/**
 * @param {string} searchString
 * @param {SearchKey} keyName
 * @return {FilterPredicate}
 */
function isTableRowContentKeyEqual(searchString, keyName) {
  return (tableRowContent) => {
    if (searchString === "") {
      return true;
    }
    return tableRowContent[keyName] === searchString;
  }
}

/**
 * @param {HTMLTableRowElement} tableRow
 */
function showTableRow(tableRow) {
  tableRow.style.display = "table-row";
}

/**
 * @param {HTMLTableRowElement} tableRow
 */
function hideTableRow(tableRow) {
  tableRow.style.display = "none";
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