<?php
$conn = mysqli_connect(
  'lollifedb.mysql.database.azure.com',
  'kimm240@lollifedb',
  'gusrb13579!',
  'data',
  '3306'
);

$what = $_POST['lifetier'];
$first_data = "상위 ";
$second_data = null;

$TierArrayData = array(0.02, 0.06, 0.11, 0.31, 0.68, 1.45, 3.67, 5.59, 7.58, 10.58, 18.36, 22.53, 29.14, 36.76, 50.21, 57.53, 66.31, 73.61, 82.76, 88.73, 92.78, 95.53, 97.93, 98.94, 99.64, 99.96, 100);
$TierArrayName = array("Challenger", "Grandmaster", "Master", "Diamond1", "Diamond2", "Diamond3", "Diamond4", "Platinum1", "Platinum2", "Platinum3", "Platinum4", "Gold1", "Gold2", "Gold3", "Gold4", "Silver1", "Silver2", "Silver3", "Silver4", "Bronze1", "Bronze2", "Bronze3", "Bronze4", "Iron1", "Iron2", "Iron3", "Iron4");
#$TierArrayName = ["Challenger", "Grandmaster", "Master", "Diamond1", "Diamond2", "Diamond3", "Diamond4", "Platinum1", "Platinum2", "Platinum3", "Platinum4", "Gold1", "Gold2", "Gold3", "Gold4", "Silver1", "Silver2", "Silver3", "Silver4", "Bronze1", "Bronze2", "Bronze3", "Bronze4", "Iron1", "Iron2", "Iron3", "Iron4"];

if($what == "학벌"){
  #from_data:
  $sum_name = $_POST['from_data'];
  $input_univ_data = $_POST['from_data'];
  $input_univ_data .= '\r';
  $sql= "SELECT * FROM university WHERE university_fullname='{$input_univ_data}'";
  $result= mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  $rank = $row['rank_of_this'];
  $ratio = ($rank / 4942) * 100;
  $first_data .= round($ratio, 2);
  $first_data .= "%";

  $tier_idx = 0;
  for($tier_idx = 0; $tier_idx < 27; $tier_idx++){
      if($TierArrayData[$tier_idx] >= $ratio) break;
  }
  $second_data = $TierArrayName[$tier_idx];

  if($result === false){
    echo '데이터를 가져오는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
  } else {
  }
}

elseif($what == "키"){
  #from_data: 181.2
  $sum_name = $_POST['from_data'];
  $sql = "SELECT * FROM height_ratio where height >= '{$_POST['from_data']}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  $ratio = $row['ratio'];
  $first_data .= round($ratio, 2);
  $first_data .= "%";

  $tier_idx = 0;
  for($tier_idx = 0; $tier_idx < 27; $tier_idx++){
      if($TierArrayData[$tier_idx] >= $ratio) break;
  }
  $second_data = $TierArrayName[$tier_idx];

  if($result === false){
    echo '데이터를 가져오는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
  } else {
  }

}

elseif($what == "거주지"){
  #서울특별시 강남구 청담동 상지리츠빌카일룸3차 265
  $sum_name = $_POST['from_data'];
  $sql = "SELECT * FROM resident WHERE resi_fullname='{$_POST['from_data']}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  $rank = $row['apart_rank'];
  $ratio = ($rank / 82726) * 100;
  $first_data .= round($ratio, 2);
  $first_data .= "%";

  $tier_idx = 0;
  for($tier_idx = 0; $tier_idx < 27; $tier_idx++){
      if($TierArrayData[$tier_idx] >= $ratio) break;
  }
  $second_data = $TierArrayName[$tier_idx];

  if($result === false){
    echo '데이터를 가져오는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
  } else {

  }
}

else{
  $what = "확인하고 싶은 인생티어를 선택해주세요.";
  $sum_name = "실패!";
  $first_data = null;
  $second_data = "돌아가세요!";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>LOL_AND_LIFE_TIER</title>
  </head>
  <body>
      <div class="card" style="width: 25rem;">
    <div class="card-body">
      <h5 class="card-title">배치 결과</h5>
      <h6 class="card-subtitle mb-2 text-muted">
          <?php echo $sum_name ?>
      </h6>
      <p class="card-text">
          <?php
          echo "<img src= '$second_data.PNG'/>";
          ?><br>
          <?php echo $what ?> <br>
          <?php echo $first_data ?>
          <?php echo $second_data ?>
      </p>
      <a href="index.php" class="card-link">돌아가기</a>
      <a href="https://lifetolol.azurewebsites.net/" class="card-link">인생티어를롤티어로변환하기</a>
    </div>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
