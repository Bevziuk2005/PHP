<?php
	
    function Add($title, $author, $year) {
		$new_book = "$title;$author;$year\n";
		
		$file = fopen("book.txt", "r");
		if ($file) {
			$books_in_library = [];
			while (($line = fgets($file)) !== false) {
				$books_in_library[] = trim($line);
			}
			fclose($file);
			
			foreach ($books_in_library as $book) {
				list($LibTitle, $LibAuthor, $LibYear) = explode(";", $book);
				if (strtolower($LibTitle) === strtolower($title) && strtolower($LibAuthor) === strtolower($author) && strtolower($LibYear) === strtolower($year)) {
					echo "ERROR! This book already exists in the library.\n";
					return;
				}
			}
		};

		$file = fopen("book.txt", "a+");
		if ($file) {
			fwrite($file, $new_book);
			fclose($file);
			echo "Book added successfully!\n";
		}
	};

	function Search($searchTitle) {
		$file = fopen("book.txt", "r");
		if ($file) {
			$books_in_library = [];
			while (($line = fgets($file)) !== false) {
				list($LibTitle, $LibAuthor, $LibYear) = explode(";", trim($line));
				if (strtolower($LibTitle) === strtolower($searchTitle)) {
					$books_in_library[] = ["title" => $LibTitle, "author" => $LibAuthor, "year" => $LibYear];
				}
			}
			fclose($file);

			if (count($books_in_library) > 0) {
				echo "Found books:\n";
				foreach ($books_in_library as $book) {
					echo "Title: {$book['title']}, Author: {$book['author']}, Year: {$book['year']}\n";
				}
			} else {
				echo "Book not found.\n";
			}
		} else {
			echo "Error opening the file for reading.\n";
		}
	};

	function CustomPrint() {
		$file = fopen("book.txt", "r");
		if ($file) {
			$books_in_library = [];
			while (($line = fgets($file)) !== false) {
				list($title, $author, $year) = explode(";", trim($line));
				$books_in_library[] = ['title' => $title, 'author' => $author, 'year' => (int)$year];
			}
			fclose($file);

			usort($books_in_library, function ($a, $b) {
				return $a['year'] <=> $b['year'];
			});

			if (count($books_in_library) > 0) {
				echo "Books sorted by year:\n";
				foreach ($books_in_library as $book) {
					echo "Title: {$book['title']}, Author: {$book['author']}, Year: {$book['year']}\n";
				}
			} else {
				echo "No books in the library.\n";
			}
		} else {
			echo "Error opening the file for reading.\n";
		}
	};

	echo "\n  -- Welcome to the library --  \n";
    echo "Commands for work with library:\n";
    echo "1. Write: '\033[31;3madd\033[0m\033[0m\033[0m\033[0m' to add a book to the library." . "\n";
    echo "2. Write: '\033[31;3msearch\033[0m\033[0m\033[0m' to search for a book in the library by title." . "\n";
    echo "3. Write: '\033[31;3mprint\033[0m\033[0m' to display all books sorted by year." . "\n";
    echo "4. Write: '\033[31;3mexit\033[0m' to exit the library system." . "\n";
	
    while (true) {
        echo "Enter a command: ";
        $command = trim(fgets(STDIN));

        if ($command === "add") {
            echo "Enter book title: ";
			$title = trim(fgets(STDIN));
			echo "Enter author: ";
			$author = trim(fgets(STDIN));
			echo "Enter year of publication: ";
			$year = trim(fgets(STDIN));
			Add($title, $author, $year);
        } elseif ($command === "search") {
			echo "Enter the title of the book you are looking for: ";
			$searchTitle = trim(fgets(STDIN));
			Search($searchTitle);
        } elseif ($command === "print") {
            CustomPrint();
        } elseif ($command === "exit") {
            echo "Exiting the library system. Goodbye!\n";
            break;
        } else {
            echo "Invalid command. Please try again.\n";
        }
    }
?>