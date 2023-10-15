$(document).ready(function() {

    $("#addVoteForm").submit(function(e) {
        e.preventDefault();
        var title = $("#voteTitle").val();
        var errorVoteContainer = $("#errorVote");
        errorVoteContainer.text("");

        if (title.trim() === "") {
            errorVoteContainer.text("Field is required")
        }
        else {
            $("#addVoteForm")[0].submit()
        }
    });

    $("#editVotes").submit(function(e) {
        e.preventDefault();

        var title = $("#inputTitle").val();
        var errorTitleContainer = $("#errorTitle");

        errorTitleContainer.text("");

        if (title.trim() === "") {
            errorTitleContainer.text("Title is required")
        }
        else {
            errorTitleContainer.text("");
            $("#editVotes")[0].submit();
        }
    });

    $("#editAnswer").submit(function(e) {
        e.preventDefault();

        let title = $("#inputTitle").val();
        let errorTitleContainer = $("#errorTitle");

        let answer = $("#inputAnswer").val();
        let errorAnswerContainer = $("#errorAnswer");

        errorTitleContainer.text("");
        //errorAnswerContainer.text("");

        if (title.trim() === "") {
            errorTitleContainer.text("Title is required")
            $("#inputTitle").focus();
        }
        else if (answer.trim() === "") {
            errorTitleContainer.text("Count is required")
            $("#inputAnswer").focus();
        }
        else if ($.isNumeric(answer) === false) {
            errorTitleContainer.text("Score must be digit")
            $("#inputAnswer").focus();
        }
        else {
            errorTitleContainer.text("");
            $("#editAnswer")[0].submit();
        }
    });

    $("#createAnswer").submit(function(e) {
        e.preventDefault();

        let title = $("#inputTitle").val();
        let errorTitleContainer = $("#errorTitle");

        let answer = $("#inputAnswer").val();
        let errorAnswerContainer = $("#errorAnswer");

        errorTitleContainer.text("");
        //errorAnswerContainer.text("");

        if (title.trim() === "") {
            errorTitleContainer.text("Title is required")
            $("#inputTitle").focus();
        }
        else if (answer.trim() === "") {
            errorTitleContainer.text("Count is required")
            $("#inputAnswer").focus();
        }
        else if ($.isNumeric(answer) === false) {
            errorTitleContainer.text("Score must be digit")
            $("#inputAnswer").focus();
        }
        else {
            errorTitleContainer.text("");
            $("#createAnswer")[0].submit();
        }
    });

    $("#storeVotes").submit(function(e) {
        e.preventDefault();

        var title = $("#inputTitle").val();
        var errorTitleContainer = $("#errorTitle");

        errorTitleContainer.text("");

        if (title.trim() === "") {
            errorTitleContainer.text("Title is required")
        }
        else {
            errorTitleContainer.text("");
            $("#storeVotes")[0].submit();
        }
    });

    $("#loginForm").submit(function(e) {
        e.preventDefault();

        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();

        var errorLoginContainer = $("#errorLogin");
        var errorPasswordContainer = $("#errorPassword");

        errorLoginContainer.text("");
        errorPasswordContainer.text("");

        if (email.trim() === "") {
            errorLoginContainer.text("Email is required.");
        } else if (!isValidEmail(email)) {
            errorLoginContainer.text("Invalid email format.");
        } else if (password.trim() === "") {
            errorPasswordContainer.text("Password is required.");
        } else {
            $.ajax({
                type: "POST",
                url: "/user/login",
                cache: false,
                data: $(this).serialize(),
                // data: {
                //     email: email,
                //     password: password
                // },
                success: function(response) {
                    console.log(response)
                    if (response.status === 'Success') {
                        window.location.href = response.url;
                    }
                    if (response.status === 'Error') {
                        $(response.elementID).text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Status: " + status + ", Error: " + error);
                }
            });

        }
    });

    $("#registerForm").submit(function(e) {
        e.preventDefault();

        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();

        var errorLoginContainer = $("#errorEmail");
        var errorPasswordContainer = $("#errorPassword");

        errorLoginContainer.text("");
        errorPasswordContainer.text("");

        if (email.trim() === "") {
            errorLoginContainer.text("Email is required.");
        } else if (!isValidEmail(email)) {
            errorLoginContainer.text("Invalid email format.");
        } else if (password.trim() === "") {
            errorPasswordContainer.text("Password is required.");
        } else {

            $.ajax({
                type: "POST",
                url: "/user/store",
                cache: false,
                data: $(this).serialize(),
                // data: {
                //     email: email,
                //     password: password
                // },
                success: function(response) {
                    console.log(response)
                    if (response.status === 'Success') {
                        window.location.href = response.url;
                    }
                    if (response.status === 'Error') {
                        $(response.elementID).text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Status: " + status + ", Error: " + error);
                }
            });
        }
    });


    function isValidEmail(email) {
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return pattern.test(email);
    }

});