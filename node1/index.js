console.log("Hello World");
let username = "david";
let edad = 46;
let hasHobbies = true;
let points = [10, 20, 30];
let user = {
  name: "Ryan",
  lastname: "ray",
};
const PI = 3.141592654;
console.log(username);
console.log(user);

if (edad > 18) {
  console.log("eres adulto");
} else {
  console.log(" eres un niño");
}
const names = ["DAvid", "Natalia", "Adriana", "Sofia"];

for (let index = 0; index < names.length; index++) {
  const element = names[index];
  console.log(element);
}

function showUserInfo(username, userage) {
  return `The username is ${username} and is ${userage} years old`;
}

const showUserInfo2 = (username, age) =>
  `The username ${username} is ${age} years old`;

console.log(showUserInfo("David", 46));
