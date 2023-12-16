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
  const avatar_url = `https://cdn.discordapp.com/avatars/${author_id}/${avatar}.jpg`;
  const editButton = isAdmin && author_id == user_id ? `<a class='btn btn-info text-nowrap' href='/news/editNewspost.php?id=${id}'><img src="/_assets/_img/icons/edit.svg"></a>` : `&nbsp;`;
  const deleteButton = isAdmin && author_id == user_id ? `<a class='btn btn-danger text-nowrap' href='/news/deleteNewspost.php?id=${id}'><img src="/_assets/_img/icons/delete.svg"></a>` : `&nbsp;`;
  const editedHTML = created_at == edited_at ? `&nbsp;` : ` (last edited at: ${convertEditedTime(`${edited_at}+00:00`, id)})`;

  const HTMLContent = `
  <div class="bg-dark">
    <table>
      <tr>
        <td rowspan=2><img src="${avatar_url}" width=64 height=64/></td>
        <td width=100%><h5>${title}</h5></td><td class="text-nowrap">${editButton} &nbsp; ${deleteButton}</td>
      </tr>
      <tr>
        <td colspan=2>By ${username} on ${convertCreatedTime(`${created_at}+00:00`, id)}${editedHTML}
        </td>
      </tr>
    </table>
    <hr/>${text}<br/><br/>
    </div>
  `;

  return HTMLContent;
}

async function getAllNews() {
  const request = await fetch('/api/news');
  const response = await request.json();
  return response;
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