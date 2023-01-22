<?php require __DIR__ . '/env.php'; ?>
<?php require __DIR__ . '/includes/public_functions.php'; ?>
<?php require __DIR__ . '/includes/head_section.php'; ?>

  <title>QuizNight | Question </title>
</head>
<body style="background-color: #120a8f;">
<div class="logo_div" align="center">
  <h1 style="color: #f9d71c;">QuizNight </h1>
</div>
<p style="text-align:center"><img alt="" src="/images/<?php echo $question_active['question']; ?>" style="border-style:solid; border-width:1px; height:250px; width:400px" /></p>
<br>
<br>
<form method="post" action="<?php echo 'question.php'; ?>">
  <table align="center" border="0" cellpadding="1" cellspacing="1" style="width:500px; margin-left: auto;margin-right: auto; border-spacing: 20px;">
    <tbody>
      <tr style="margin-bottom: auto;">
        <td align="center"><button type="submit" class="button-27" name="answera"><?php echo $question_active['A']; ?> </button></td>
        <td align="center"><button type="submit" class="button-27" name="answerb"><?php echo $question_active['B']; ?> </button></td>
      </tr>
      <tr style="margin-bottom: auto;">
        <td align="center"><button type="submit" class="button-27" name="answerc"><?php echo $question_active['C']; ?> </button></td>
        <td align="center"><button type="submit" class="button-27" name="answerd"><?php echo $question_active['D']; ?> </button></td>
      </tr>
    </tbody>
  </table>
</form>


<?php require __DIR__ . '/includes/footer.php'; ?>