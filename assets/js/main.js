function handleSignUp(e) {
    const username = e.target.querySelector("input[name='username']").value;
    const email = e.target.querySelector("input[name='email']").value;
    const pass = e.target.querySelector("input[name='password']").value;
    const passRetype = e.target.querySelector("input[name='password_retype']").value;

    if (username === 'admin' || email === 'admin@comptech.com') {
        alert("Forbidden username or email");
        e.preventDefault();
    }

    if (pass !== passRetype) {
        alert("Passwords do not match");
        e.preventDefault();
    }
}

function handleProdDel(id) {
    if (confirm(`Are you sure to delete product with id "${id}"`)) {
        window.location = `services/process.php?action=del-product&id=${id}`;
    }
}