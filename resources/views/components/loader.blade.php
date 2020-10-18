@push('styles')
<style>
    :root {
        --yellow: #feb60a;
        --red: #ff0062;
        --blue: #00dbf9;
        --violet: #da00f7;
    }

    .body {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        /*background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.15) 0%, rgba(0, 153, 212, 0) calc(15% + 100px), rgba(0, 99, 138, 0) calc(85% + 100px), rgba(0, 0, 0, 0.15) 100%);*/
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .subdiv {
        width: 3vw;
        height: 3vw;
        border-radius: 100%;
        margin: 2vw;
        background-image: linear-gradient(145deg, rgba(255, 255, 255, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
        animation: bounce 1.5s 0.5s linear infinite;
    }

    .yellow {
        background-color: var(--yellow);
    }

    .red {
        background-color: var(--red);
        animation-delay: 0.1s;
    }

    .blue {
        background-color: var(--blue);
        animation-delay: 0.2s;
    }

    .violet {
        background-color: var(--violet);
        animation-delay: 0.3s;
    }

    @keyframes bounce {

        0%,
        50%,
        100% {
            transform: scale(1);
            filter: blur(0px);
        }

        25% {
            transform: scale(0.6);
            filter: blur(3px);
        }

        75% {
            filter: blur(3px);
            transform: scale(1.4);
        }
    }

</style>
@endpush
<div class="body">
    <div class="container">
        <div class="subdiv yellow"></div>
        <div class="subdiv red"></div>
        <div class="subdiv blue"></div>
        <div class="subdiv violet"></div>
    </div>
</div>
