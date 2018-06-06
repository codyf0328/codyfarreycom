# Select Statements
# Cody Farrey
# CSCI-466

# NOTE: Do not try to run this as a sql script.
# 		I only saved it as .sql so you guys can see the syntax.

#Searching:
$searchQuery = "SELECT DISTINCT song.songID, title, artist FROM song, contributors, contributions 
WHERE contributions.songID = song.songID AND contributors.cID = contributions.cID AND " . $_POST['searchParam'] . " LIKE '%" . $_POST['searchKey'] . "%';";
	# - In PHP $_POST['searchParam'] will be whatever we chose form the drop down menu:
	#	title, artist or contribution.
	# - In PHP $_POST['searchKey'] will be what we are searching using the LIKE search terms
	# will find anything that contains whatever string we type.

	# EXAMPLE:

		SELECT songID, title, artist FROM song WHERE title LIKE '%you%';

	#	Outputs:

	#	I Miss You - Blink 182
	#	When You Were Young - The Killers

#Outputting FFA Queue:

		SELECT user.name, song.title, song.artist, kFile.filename
		FROM submission, user, song, kFile
		WHERE amtPaid = 0
		AND submission.kID = kFile.kID
		AND submission.uID = user.uID
		AND kFile.songID = song.songID
		ORDER BY submission.time;


#Outputting Paid Queue;

		SELECT user.name, song.title, song.artist, kFile.filename
		FROM submission, user, song, kFile
		WHERE amtPaid > 0
		AND submission.kID = kFile.kID
		AND submission.uID = user.uID
		AND kFile.songID = song.songID
		ORDER BY amtPaid DESC, time;
