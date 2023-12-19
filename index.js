document.addEventListener("DOMContentLoaded", main);


async function main() {
  const allNews = await getAllNews();
  const addNewsContainer = document.querySelector("#addNews");
  const newsContainer = document.querySelector("#news");
  const content = allNews.news.map((newspost) => getNewspostContent(newspost, allNews.admin, allNews.user_id)).join("");
  addNewsContainer.innerHTML = allNews.admin ? `<a href="/news/addNews.php" class="btn btn-primary">Add Newspost!</a><br/><br/>` : `&nbsp;`;
  newsContainer.innerHTML = content;
}

function getNewspostContent(newspost, isAdmin, user_id) {
  const id = newspost.post_id;
  const author_id = newspost.post_author; 
  const title = newspost.post_title;
  const text = newspost.post_text;
  const created_at = newspost.created_at;
  const edited_at = newspost.edited_at;
  const avatar = newspost.discord_avatar;
  const username = newspost.discord_username;
  const avatar_url = avatar ? `https://cdn.discordapp.com/avatars/${author_id}/${avatar}.jpg` : `https://static-cdn.jtvnw.net/jtv_user_pictures/f6dd682a-ce61-40d1-ab3a-54dc6c174092-profile_image-70x70.png`;
  const editButton = isAdmin || author_id == user_id ? `<a class='btn btn-info text-nowrap' href='/news/editNewspost.php?id=${id}'><img src="/_assets/_img/icons/edit.svg"></a>` : `&nbsp;`;
  const deleteButton = isAdmin || author_id == user_id ? `<a class='btn btn-danger text-nowrap' href='/news/deleteNewspost.php?id=${id}'><img src="/_assets/_img/icons/delete.svg"></a>` : `&nbsp;`;
  const editedHTML = created_at == edited_at ? `&nbsp;` : ` (last edited at: ${convertEditedTime(`${edited_at}+00:00`, id)})`;

  const HTMLContent = `
  <div class="bg-dark">
    <table>
      <tr>
        <td rowspan=2><img src="${avatar_url}" width=64 height=64/></td>
        <td width=100%><h5>${title}</h5></td><td class="text-nowrap">${editButton} &nbsp; ${deleteButton}</td>
      </tr>
      <tr>
        <td colspan=2>By <a href="/users/${author_id}">${username}</a> on ${convertCreatedTime(`${created_at}+00:00`, id)}${editedHTML}
        </td>
      </tr>
    </table>
    <hr/>${replaceURLs(text)}<br/><br/>
    </div><br/><br/>
  `;

  return HTMLContent;
}

function replaceURLs(text) {
  // Put the URL to variable $1 after visiting the URL
  const Rexp = new RegExp(/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/g);
 
  // Replace the RegExp content by HTML element
  const links = text.match(Rexp);
  if(links) {links.forEach(element => {
    element[0] = element[0].replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
    text = text.replaceAll(element, `<a href="${element}" target="_blank">${element}</a>`)
  });}
  return text;
}

async function getAllNews() {
  try {
    const response = await fetch(`/api/news`);
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

function convertCreatedTime(time, id) {
    let options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
      };
    time = new Intl.DateTimeFormat('sv', options).format(new Date(time));
    return time;
}

function convertEditedTime(time, id) {
    let options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
      };
    time = new Intl.DateTimeFormat('sv', options).format(new Date(time));
    return time;
}