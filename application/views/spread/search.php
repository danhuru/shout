//connect to your database

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT description as value,id FROM test WHERE description LIKE '%".$term."%'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
$row['value']=htmlentities(stripslashes($row['value']));
$row['id']=(int)$row['id'];
$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data