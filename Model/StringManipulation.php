<?php
function string_between_two_string($str, $starting_word, $ending_word)
{
$subtring_start = strpos($str, $starting_word);
//Adding the starting index of the starting word to
//its length would give its ending index
$subtring_start += strlen($starting_word);
//Length of our required sub string
$size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
// Return the substring from the index substring_start of length size
return trim(substr($str, $subtring_start, $size));
}

function LimitVisibleString($str)
{
  if (strlen($str) > 850)
  {
      // truncate string
      $stringCut = substr($str, 0, 850);
      $endPoint = strrpos($stringCut, ' ');

      //if the string doesn't contain any space then it will cut without word basis.
      $str = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
      $str .= '... <a href="/this/story">Read More</a>';
  }
  return $str;
}

?>
<style>
    .show-read-more .more-text{
        display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function()
{
	let maxLength = 550;
	$(".show-read-more").each(function()
  {
		let myStr = $(this).text();
		if($.trim(myStr).length > maxLength)
    {
			let newStr = myStr.substring(0, maxLength);
			let removedStr = myStr.substring(maxLength, $.trim(myStr).length);
			$(this).empty().html(newStr);
			$(this).append('<a href="javascript:void(0);" class="read-more">Show More</a>');
			$(this).append('<p class="more-text">' + removedStr + '</p>');
		}
	});

	$(".read-more").click(function()
  {
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
	});

});
</script>
