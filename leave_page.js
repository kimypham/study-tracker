// Study Tracker - 'leaving page without saving?' prompt, version 1.3, Kim Pham
// a prompt is sent to the user if they leave the page.

// code from user Mike on StackOverflow (https://stackoverflow.com/questions/1119289/how-to-show-the-are-you-sure-you-want-to-navigate-away-from-this-page-when-ch)
window.onbeforeunload = function() { // onbeforeunload function documentation - https://developer.mozilla.org/en-US/docs/Web/Events/beforeunload
  return true;
};

$('.allow-navigation').on('click', function(e) { // disables onbeforeunload for certain elements
    $(window).off('beforeunload');
    console.log('page navigation allowed');
});