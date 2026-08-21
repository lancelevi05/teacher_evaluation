<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forbidden</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #191d2b;
            color: #d9dce5;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;
        }

        .error-container {
            text-align: center;
        }

        .error-title {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 16px;

            font-size: 20px;
            font-weight: 400;
            letter-spacing: 0.5px;

            color: #d9dce5;
        }

        .error-code {
            font-weight: 700;
        }

        .divider {
            width: 1px;
            height: 25px;
            background: #747985;
        }

        .countdown {
            margin-top: 25px;

            font-size: 14px;
            color: #858a98;
        }

        #seconds {
            color: #d9dce5;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="error-container">

    <div class="error-title">
        <span class="error-code">403</span>

        <span class="divider"></span>

        <span>UNAUTHORIZED ACCESS.</span>
    </div>

    <div class="countdown">
        Redirecting to your dashboard in
        <span id="seconds">5</span>
        seconds...
    </div>

</div>

<script>
    let seconds = 5;

    const countdown = document.getElementById('seconds');

    const timer = setInterval(() => {
        seconds--;

        countdown.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(timer);

            window.location.href = @json($redirectRoute);
        }
    }, 1000);
</script>

</body>
</html>