<php

/*
Question 1 / 3 (FizzBuzz)
Write a program which prints the numbers from 1 to N, each on a new line. But for multiples of three print “Fizz” instead of the number 3 and for the multiples of five print “Buzz”.  For numbers which are multiples of both three and five print “FizzBuzz”. Read in the input number from STDIN.

Sample Input #00:

15

Sample Output #00 :

1
2
Fizz
4
Buzz
Fizz
7
8
Fizz
Buzz
11
Fizz
13
14
FizzBuzz

 

Explanation:

Position 3,6,9,12 have the word "Fizz" because they are multiples of 3.

Positions 5 and 10 have the word "Buzz" because they are multiples of 5.  

Position 15 has the word FizzBuzz because it is a multiple of both 3 and 5.  

 

Constraints :

N < 107


*/

 /* Enter your code here. Read input from STDIN. Print output to STDOUT */
    //initialize $n value
    
    $file_read = fopen("php://stdin", "r");
    $file_write = fopen("php://stdout", "w");

    fscanf($file_read, "%d", $n);

    $stdin = fopen('php://stdin', 'r');

    //$n = $stdin;


    for ($i=1; $i<=$n; $i++) {
        
        if ($i%3==0 && $i%5!==0 ) {
            print "Fizz\n";
        } else if ($i%3!=0 && $i%5==0) {
            print "Buzz\n";
        } else if ($i%3==0 && $i%5==0) {
            print "FizzBuzz\n";
        } else {
            print "$i\n";
        }
    }
	
	
	/*
------------------

Question 2 / 3 (Number Complement)
A complement of a number is defined as the inversion (if the bit value = 0, change it to 1 and vice-versa) of all bits of the number starting from the leftmost bit that is set to 1. For example, if N = 5, N is represented as 101 in binary. The complement of N is 010, which is 2 in decimal notation. Similarly if N = 50, then the complement of N is 13. Complete the function getIntegerComplement(). This function accepts N as parameter. The function should return the complement of N.The section of the program which parses the input and displays the output will be handled by us. Your task is to complete the body of the function or method provided, and to return the correct output.


Constraints :
0 ≤ N ≤ 100000.

Sample Test Cases: 

Input #00:
50

Output #00:
13

Explanation:

50 in decimal form equals: 110010 when converted to binary.
Inverting the bit sequence: 001101. This is the binary equivalent of decimal 13.

Input #01:
100

Output #01:
27

Explanation:

The bit sequence for 100 is 1100100. Inverting the sequence gives 0011011 which is the binary equivalent of decimal 27.


*/

function  getIntegerComplement($n) {

    $dBinary = str_split(decbin($n));
    
    foreach($dBinary as $key=>$val) {
        if ($val == 0) $dBinary[$key] = 1;
        elseif ($val == 1) $dBinary[$key] = 0;
        
    }
                         
    $implode = implode('', $dBinary);
    $toDecimal = bindec($implode);
    
    
                         
    return $toDecimal;                     
}
                         
$file_read = fopen("php://stdin", "r");
fscanf($file_read, "%d", $stdin);

print getIntegerComplement($stdin);   

//print sprintf('%05d', decbin(getIntegerComplement($stdin))); 

/*

------------------

Question 3 / 3 (K Difference)
K Difference

Given N numbers , [N<=10^5] we need to count the total pairs of numbers which have a difference of K. [K>0 and K<10^9]. The solution should have as low of a computational time complexity as possible. 


Input Format:

1st line contains N & K (integers).
2nd line contains N numbers of the set. All the N numbers are assured to be distinct.


Output Format:

One integer saying the no of pairs of numbers that have a diff K.

Sample Input #00:
5 2
1 5 3 4 2

Sample Output #00:
3

Explanation:
The possible pairs are (5,3), (4,2) and (3,1).
 
 
Sample Input #01:
10 1
363374326 364147530 61825163 1073065718 1281246024 1399469912 428047635 491595254 879792181 1069262793 
 
Sample Output #01:
0
 
Explanation:
There are no such pairs.
 
Read input from STDIN and write output to STDOUT. 



*/

 /* Enter your code here. Read input from STDIN. Print output to STDOUT */
    
$file_read = fopen("php://stdin", "r");
$file_write = fopen("php://stdout", "w");

fscanf($file_read, "%d", $total_numbers);
fscanf($file_read, "%d", $diff);

$num_arrays = array();
for ($i = 0; $i < $total_numbers; $i++) {
    fscanf($file_read, "%d", $num_arrays[$i]);
}

$count = 0;
sort($num_arrays);
for ($i = $total_numbers - 1; $i > 0; $i--) {
    for ($j = $i - 1; $j >= 0; $j--) {
        if ($num_arrays[$i] - $num_arrays[$j] == $diff) {
            $count++;
            $j = 0;
        }
    }
}
fprintf($file_write, "%d", $count);  
    
	
	
