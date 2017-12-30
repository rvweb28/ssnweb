function setNavActive(href) {

  $('.navbar-right a[href="'+href+'"]').attr('id', 'active-nav');
}
function setDropdownActive(id) {

  $('.navbar-right a[data-id="'+id+'"]').attr('id', 'active-nav');
}

var currentSize = 18;

function increaseFontSize() {

  var size = currentSize + 1;

  if(size > 26) size = currentSize;

  changeFontSize(size);
}
function decreaseFontSize() {

  var size = currentSize - 1;

  if(size < 12) size = currentSize;

  changeFontSize(size);
}
function resetFontSize() {

  changeFontSize(18);
}

function changeFontSize(newSize) {

  changeFontSizeForElement('p', currentSize, newSize);
  changeFontSizeForElement('li', currentSize, newSize);
  changeFontSizeForElement('a', currentSize, newSize);
  changeFontSizeForElement('strong', currentSize, newSize);
  changeFontSizeForElement('span', currentSize, newSize);
  changeFontSizeForElement('h1', currentSize, newSize);
  changeFontSizeForElement('h2', currentSize, newSize);
  changeFontSizeForElement('h3', currentSize, newSize);
  changeFontSizeForElement('h4', currentSize, newSize);
  changeFontSizeForElement('h5', currentSize, newSize);
  changeFontSizeForElement('h6', currentSize, newSize);

  currentSize = newSize;
}
function calculateNewFontSize(elem, oldSize, newSize) {

  var factor = newSize / oldSize;

  var elemSize = parseInt($(elem).css('font-size'));

  return factor * elemSize;
}
function changeFontSizeForElement(elem, oldSize, newSize) {

  $(elem).css('font-size', calculateNewFontSize(elem, oldSize, newSize));
}


$(document).ready(function() {

  var inNav = false;

  $('.navbar').mouseover(function() {
    inNav = true;
  });

  $('.navbar').mouseout(function() {
    inNav = false;
  });

  $('#nav-btn').on('blur', function() {

    if(!inNav) {

      closeNavbar();

    } else {

      setTimeout(function() { $('#nav-btn').focus(); }, 10);
    }
  });

  function closeNavbar() {

    $('.navbar-collapse').collapse('hide');
  }
});
