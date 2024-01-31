const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question("Enter your name: ", function(userInput) {
  const output = `Hello ${userInput} Welcome To World of JavaScript`;
  console.log(output);
  rl.close();
});
