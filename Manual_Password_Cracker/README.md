# Manual Password Cracker

Started with an etc/shadow file and a word dictionary file.</br>

Steps I took.</br>

1.&nbsp; I had to parse the shadow file and isolate the hashes that were not hidden.</br>
2.&nbsp; I used sed and grep to make a final small file with only the hashes to run against.

sed '/!!/d; /*/d' ./shadowtester >> moddedShadow </br>
grep -oP '^[^\:]*\:\K[^\:]+' moddedShadow

The final parsed password file format: </br>

# $id$salt$hash
