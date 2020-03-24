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
		<h1 align="center">Appointments</h1>
		<button><a href="http://localhost/patient.php">Patients</a></button>
		<table border="3">
			<tr>
				<td><h2>Patient Firstname</h2></td>
				<td><h2>Patient Lastname</h2></td>
				<td><h2>Patient Picture</h2></td>
				<td><h2>Appointment Date</h2></td>
				<td><h2>Treatment Type</h2></td>
				<td><h2>Specialist Firstname</h2></td>
				<td><h2>Specialist Lastname</h2></td>
				<td><h2>Appointment Bill</h2></td>
			</tr>
			<?php
				$host = "localhost";
				$host1 = "http://localhost";
				$user = "root";
				$password = "";
				$database = "patientsdb";
				$query = "Select p.pid, p.fname as pfname, p.lname as plname, p.patientpic_path, a.appDate, t.treatment, s.fname, s.lname from patient as p inner join appointment as a on p.pid = a.pid inner join treatment as t on a.sid = t.sid inner join specialist as s on t.sid = s.sid";
				$link_address = "http://localhost/bill.php";
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
					echo "<td><h2>" .$row['pfname'] . "</h2></td>";
					echo "<td><h2>" .$row['plname'] . "</h2></td>";
					echo "<td><h2><img src=".$host1.$row['patientpic_path'] . " width=100 height=100/></h2></td>";
					echo "<td><h2>" .$row['appDate'] . "</h2></td>";
					echo "<td><h2>" .$row['treatment'] . "</h2></td>";
					echo "<td><h2>" .$row['fname'] . "</h2></td>";
					echo "<td><h2>" .$row['lname'] . "</h2></td>";
					echo "<td><h2><a href='$link_address?pid=" .$row['pid'] . "'>Bill</a></h2></td>";
					//echo "<td><h2><a href='$link_address?pid=10'>Bill</a></h2></td>";
				    echo "</tr>";
				}
			?>
		<table>
	</body>
</html>