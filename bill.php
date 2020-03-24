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
		<h1 align="center">Bill</h1>
		<button><a href="http://localhost/patient.php">Patients</a></button><button><a href="http://localhost/appointments.php">Appointments</a></button>
		<table border="3">
			<tr>
				<td><h2>Patient Firstname</h2></td>
				<td><h2>Patient Lastname</h2></td>
				<td><h2>Appointment Date</h2></td>
				<td><h2>Treatment Type</h2></td>
				<td><h2>Cost of Treatment</h2></td>
				<td><h2>Payment Method</h2></td>
				<td><h2>Payment Status</h2></td>
			</tr>
			<?php
				$host = "localhost";
				$host1 = "http://localhost";
				$user = "root";
				$password = "";
				$database = "patientsdb";
				$PatientID = $_GET['pid'];
				
				$query = "Select p.pid, p.fname as pfname, p.lname as plname, a.appDate, t.treatment, b.cost, p1.method, p1.status from patient as p inner join appointment as a on p.pid = a.pid inner join treatment as t on a.sid = t.sid inner join bill as b on p.pid = b.pid inner join payment as p1 on p1.paymentid = b.paymentid where p.pid = " . $PatientID;
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
					echo "<td><h2>" .$row['appDate'] . "</h2></td>";
					echo "<td><h2>" .$row['treatment'] . "</h2></td>";
					echo "<td><h2>" .$row['cost'] . "</h2></td>";
					echo "<td><h2>" .$row['method'] . "</h2></td>";
					echo "<td><h2>" .$row['status'] . "</h2></td>";
				    echo "</tr>";
				}
			?>
		<table>
	</body>
</html>