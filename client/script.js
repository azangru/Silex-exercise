var form = document.querySelector('#fileform');
var fileField = document.querySelector('#filefield');
form.addEventListener('submit', formSubmit, false);


function formSubmit(e) {
  e.preventDefault();

  let formData = new FormData(form);
  // let file = fileField.files[0];
  // formData.append('uploadedFile', file);

  let config = {
    method: 'POST',
    mode: 'cors',
    cache: 'default',
    body: formData
  };

  fetch('http://localhost:8000/uploads/assignment', config).then((response) => {
    console.log('submitted!');
  });
}
