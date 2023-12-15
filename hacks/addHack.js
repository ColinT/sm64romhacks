document.addEventListener("DOMContentLoaded", main);

async function main() {
    const data = await getData()
    const hacks = data.hacks
    const dataList = getDataList(hacks);
    const dataListContainer = document.querySelector("#hack_name_options")

    dataListContainer.innerHTML = dataList
}

async function getData() {
    const request = await fetch("/api?hack_name=all")
    const response = await request.json()
    return response
}

function getDataList(hacks) {
    const htmlContent = hacks.map((hack) => {
        return `<option value="${hack.hack_name}">`
    }).join("")

    return htmlContent.toString();
}