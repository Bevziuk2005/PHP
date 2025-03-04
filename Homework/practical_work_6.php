<?php

	srand(14072005); // seed for random
	
	$students = [
		["name" => "Alex", "surname" => "Ivanov", "age" => rand(17, 25), "average_score" => rand(1, 100)],
		["name" => "Maria", "surname" => "Petrenko", "age" => rand(17, 25), "average_score" => rand(1, 100)],
		["name" => "Mark", "surname" => "Sydorenko", "age" => rand(17, 25), "average_score" => rand(1, 100)],
		["name" => "Victor", "surname" => "Kovalenko", "age" => rand(17, 25), "average_score" => rand(1, 100)],
		["name" => "Natalia", "surname" => "Honcharova", "age" => rand(17, 25), "average_score" => rand(1, 100)],
	];
	
	function StudentWithAScore($students) {
		echo "\033[4mEnter the minimum average score:\033[0m" . " ";
		$minnum = trim(fgets(STDIN));
		
		foreach ($students as $st) {
			if ($st["average_score"] > $minnum) {
				echo "{$st['name']} {$st['surname']}. Becouse {$st["average_score"]} > {$minnum}" . "\n";
			}
		}
	}
	
	StudentWithAScore($students);
	
	function AverageAgeInGroup($students) {
		$all_score = 0;
		foreach ($students as $st) {
			$all_score += $st["average_score"];
		}
		
		echo "Average age in students group " . "\033[34m" . ($all_score / count($students)) . "\033[0m" . "\n";
	}
	
	AverageAgeInGroup($students);
	
	function MySortStudents ($students) {
		echo "\033[31mBefore:\033[0m\n";
		foreach ($students as $student) {
			echo $student['average_score'] . " - " . $student["name"] . " " . $student["surname"] . "\n";
		}
		
		usort ($students, function($a, $b) {
			return $a["average_score"] <=> $b["average_score"];
		});
		
		echo "\033[31mAfter:\033[0m\n";
		foreach ($students as $student) {
			echo $student['average_score'] . " - " . $student["name"] . " " . $student["surname"] . "\n";
		}
	}
	
	MySortStudents($students);

?>
