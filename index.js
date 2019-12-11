if('serviceWorker' in navigator){
    window.addEventListener('load', () => {    
        navigator.serviceWorker.register('/sw.js')
        .then((reg) => {
            console.log('Service Worker registered.', reg);
        });
    });
}

let deferredPrompt;
const addBtn = document.querySelector('.add-button');
addBtn.style.display = 'none';

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    addBtn.style.display = 'block';

    addBtn.addEventListener('click', (e) => {
        addBtn.style.display = 'none';

        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if(choiceResult.outcome === 'accepted'){
                console.log('USer accepted twibbonin prompt');
            } else{
                console.log('User dismissed the twibbonin prommpt');
            }
            deferredPrompt = null;
        })
    })
})