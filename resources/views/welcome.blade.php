<html>
<head>
<style>
    h1::before {
        transform: scaleX(0);
        transform-origin: bottom right;
    }

    h1:hover::before {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    h1::before {
        content: " ";
        display: block;
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        inset: 0 0 0 0;
        background: hsl(200 100% 80%);
        z-index: -1;
        transition: transform .3s ease;
    }

    h1 {
        position: relative;
        font-size: 5rem;
    }

    html {
        block-size: 100%;
        inline-size: 100%;
    }

    body {
        min-block-size: 100%;
        min-inline-size: 100%;
        margin: 0;
        box-sizing: border-box;
        display: grid;
        place-content: center;
        font-family: system-ui, sans-serif;
    }

    @media (orientation: landscape) {
        body {
            grid-auto-flow: column;
        }
    }

</style>
</head>
<body>
<h1>Jong</h1>
<br>
<h1>Jong</h1>
</body>
</html>
