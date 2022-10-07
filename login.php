
<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  margin-left: 200px;
  margin-right: 200px;
}
</style>
<body>

<h3 align="center">Blooms Academy Abuja</h3>
<h3 align="center">Student Result</h3>
<div>
  <form action="student_dashboard.php" method="POST">
    <label for="registration_number">Registration Number</label>
    <input type="text" id="registration_number" name="registration_number" placeholder="Enter Registration Number">


  
    <input type="submit" value="Check">
  </form>
</div>

</body>
</html>


