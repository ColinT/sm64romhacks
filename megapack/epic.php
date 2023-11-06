			<?php
				function csvToTable($csvname){
					$csvfile=file($csvname);
					$sep=",";
					print "<table border=1 width=100%>";
					print "<tr><th>Name</th><th>Creator</th><th>Star Count</th><th>Release Date</th></tr>\n";
					foreach($csvfile as $lines){
						print "<tr>";
						$elements=explode($sep,$lines);
						foreach($elements as $element){
							print "<td>$element</td>";
						}
						print "</tr>";
					}
				}

				csvToTable("megapack.csv");
			?>
