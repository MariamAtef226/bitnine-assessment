function palindromeChecker(string){
    let rev = string.split('').reverse().join('');
    if (rev===string){
        return "It's palindrome!";
    }
    else{
        return "Not palindrome: " + rev
    }

}


const string = prompt('Enter a string: ');

const result = palindromeChecker(string);
console.log(result)