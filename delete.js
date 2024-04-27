const deleteButton = document.querySelector(".btn-danger");

function confirmDelete() {

  const confirmation = confirm("Are you sure you want to delete?");

  if (confirmation) {
    document.getElementById("confirmDeleteInput").value = "true";
    return true;
  } else {
    return false;
  }
}

deleteButton.addEventListener('click', confirmDelete);


