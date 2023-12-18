document.addEventListener("DOMContentLoaded", main);

async function main() {
    const allUsers = await getAllUsers();
    const usersTable = getUsersTable(allUsers);
    const usersContainer = document.querySelector("#users");
    usersContainer.innerHTML = usersTable;
}

async function getAllUsers() {
    const request = await fetch('/api/users');
    const response = await request.json();
    return response;
}

function getUsersTable(allUsers) {
    const tableHeaderRow = getUsersTableHeaderRow();
    const tableContent = allUsers.map((user) => getTableRowFromUser(user)).join("");

    return `
        <table class="table-bordered">
            ${tableHeaderRow}
            ${tableContent}
        </table>
    `
}

function getUsersTableHeaderRow() {
  
    return `
      <tr>
        <th><b>Profile Picture</b></th>
        <th><b>ID</b></th>
        <th><b>Username</b></th>
        <th><b>E-Mail</b></th>
        <th>Created At</th>
      </tr>
    `;
}

function getTableRowFromUser(user) {
    const user_id = user.discord_id;
    const user_name = user.discord_username;
    const user_email = user.discord_email;
    const user_created_at = user.created_at;
    const avatar = user.discord_avatar;
    
    return `
      <tr>
        <td class="text-center"><img src="https://cdn.discordapp.com/avatars/${user_id}/${avatar}.jpg" height="48" width="48"></td>
        <td><a href="/users/${user_id}">${user_id}</a></td>
        <td>${user_name}</td>
        <td>${user_email}</td>
        <td>${user_created_at}</td>
      </tr>
    `;
  }
  
  