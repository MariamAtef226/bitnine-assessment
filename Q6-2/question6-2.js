
// divide and conquer
function findMissing(numbers,s,e){
    if (s==e)
        return numbers[s]-1
    let mid = parseInt((s+e)/2);
    // if number exceed previous by only 1 and exceeds its index by only 1, then the missing number is on the right
    if (numbers[mid] == numbers[mid-1]+1 && numbers[mid] == mid+1){
        return findMissing(numbers,mid+1,e)
    }
    else{
        return findMissing(numbers,s,mid)
    }
}


let numbers = [1,2,3,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,26,45,4];
numbers.sort((a, b) => a - b); // in case of unarranged input
console.log(findMissing(numbers,0,numbers.length-1))
