<?php
//Send utf-8 header before any output
header('Content-Type: text/html; charset=utf-8'); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mulcahy's Dental Database</title>
	</head>	
	<body>
		<h1 align="center">Mulcahy's Dental Database</h1>
		<button><a href="http://localhost/appointments.php">Appointments</a></button>
		<table border="3">
			<tr>
				<td><h2>Patient ID</h2></td>
				<td><h2>Firstname</h2></td>
				<td><h2>Lastname</h2></td>
				<td><h2>Date of Birth</h2></td>
				<td><h2>Email</h2></td>
				<td><h2>Address</h2></td>
				<td><h2>Patient Pic</h2></td>
			</tr>
			<?php			
				$host = "localhost";
				$host1 = "http://localhost";
				$user = "root";
				$password = "";
				$database = "patientsdb";				
				
				$query = "Select * from patient";
				//Connect to the database
				$connect = mysqli_connect($host,$user,$password,$database) or die("Problem connecting.");
				//Set connection to UTF-8
				mysqli_query($connect,"SET NAMES utf8");
				//Select data
				$result = mysqli_query($connect,$query) or die("Bad Query.");
				mysqli_close($connect);

				while($row = $result->fetch_array())
				{		
					echo "<tr>";
					echo "<td><h3>" .$row['pid'] . "</h3></td>";
					echo "<td><h3>" .$row['fname'] . "</h3></td>";
					echo "<td><h3>" .$row['lname'] . "</h3></td>";
					echo "<td><h3>" .$row['dob'] . "</h3></td>";
					echo "<td><h3>" .$row['email'] . "</h3></td>";
					echo "<td><h3>" .$row['address'] . "</h3></td>";
					echo "<td><h3><img src=".$host1.$row['patientpic_path'] . " width=100 height=100/></h3></td>";
				    echo "</tr>";
				}
			?>
		<table>
	</body>
</html>