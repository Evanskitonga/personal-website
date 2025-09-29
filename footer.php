<?php
// footer.php
?>
<footer style="padding:30px; text-align:center;">
  <p>&copy; <?=date('Y')?> SnavyTosh. All rights reserved.</p>
</footer>

<script>
  // mobile menu toggle
  const nav = document.querySelector("nav");
  const toggle = document.querySelector(".menu-toggle");
  if(toggle){
    toggle.addEventListener("click", () => {
      nav.classList.toggle("active");
    });
  }
</script>
