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
				<td><h2>Appointment ID</h2></td>
				<td><h2>Bill ID</h2></td>
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
					echo "<td><h2>" .$row['pid'] . "</h2></td>";
					echo "<td><h2>" .$row['fname'] . "</h2></td>";
					echo "<td><h2>" .$row['lname'] . "</h2></td>";
					echo "<td><h2>" .$row['dob'] . "</h2></td>";
					echo "<td><h2>" .$row['email'] . "</h2></td>";
					echo "<td><h2>" .$row['address'] . "</h2></td>";
					echo "<td><h2>" .$row['appid'] . "</h2></td>";
					echo "<td><h2>" .$row['billid'] . "</h2></td>";
					echo "<td><h2><img src=".$host1.$row['patientpic_path'] . " width=100 height=100/></h2></td>";
				    echo "</tr>";
				}
			?>
		<table>
	</body>
</html>