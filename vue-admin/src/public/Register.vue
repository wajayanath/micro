<template>
    <main class="form-signin">
    <form>
        <h1 class="h3 mb-3 fw-normal">Please Register</h1>

        <label for="first_name" class="visually-hidden">First Name</label>
        <input type="text" id="first_name" class="form-control" placeholder="First Name" required>

        <label for="last_name" class="visually-hidden">Last Name</label>
        <input type="text" id="last_name" class="form-control" placeholder="Last Name" required>

        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>

        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <label for="passwordConfirm" class="visually-hidden">Password Confirm</label>
        <input type="password" id="passwordConfirm" class="form-control" placeholder="Password Confirm" required>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    </form>
    </main>
</template>

<script>
    export default {
        name: "Register"
    }
</script>

<style scoped>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>