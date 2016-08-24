<html>
<head>
<script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#test').attr('src', e.target.result);
       }
        reader.readAsDataURL(input.files[0]);
       }
    }
</script>
</head>
<body>
<form id="form1" runat="server">
<input onchange="readURL(this);" type="file" />
      <img alt="Image Display Here" id="test" src="#" />
  </form>
</body>
</html>