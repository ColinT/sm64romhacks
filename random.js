document.addEventListener("DOMContentLoaded", main);

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

var startTime, endTime;

async function main() {
  const allHacks = await getAllHacks();
  const hacksTable = getHacksTable(allHacks);
  const randomHackDiv = document.querySelector("#randomHack");
  randomHackDiv.innerHTML = hacksTable;
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
  const random = Math.floor((Math.random() *  hacks.length) + 1);
  const hack = getTableRowFromHack(hacks[random]);


  return `
    <table id='myTable' border='1' align='center'>
      ${headerRow}
      ${hack}
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
      <th><b>Creator</b></th>
      <th hidden>Initial Release Date (yyyy-mm-dd)</th>
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
  const hackCreators = getAllCreatorsOfHack(hack);
  const releaseDate = hack.releaseDate;
  const tag = hack.tag;

  // TODO: use the correct relative url path
  // Might need to add this to data.json or use single page app framework
  return `
    <tr>
      <td><a href="hacks/${getURLName(hackName)}">${hackName}</a></td>
      <td>${hackCreators}</td>
      <td hidden>${releaseDate}</td>
      <td hidden>${tag}</td>
    </tr>
  `;
}

function getURLName(hackName)
{
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

function start() {
  startTime = new Date();
};

function end() {
  endTime = new Date();
  var timeDiff = endTime - startTime; //in ms
  // strip the ms

  // get seconds 
  console.log(timeDiff + " millseconds");
}