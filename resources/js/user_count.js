const res = await fetch("/user/online_count");
const data = await res.json();

const userCountElement = document.querySelector("#users-online");

userCountElement.innerHTML = data + " gebruikers online";
