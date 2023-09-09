function printall() {
    for (var i=0; i<window.frames.length; i++) {
      window.frames[i].focus();
      window.frames[i].print();
    }
}       