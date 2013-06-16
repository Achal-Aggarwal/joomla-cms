for f in $(find -not -path '*/\.*' -type d); do 
	if [[ ! -a "$f/index.html" ]]; then
    	echo "$f/index.html does not exist!"
	fi 
done