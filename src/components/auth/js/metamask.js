document.getElementById('connect-button').addEventListener('click', event => {
    let account;
    let button = event.target;
    ethereum.request({method: 'eth_requestAccounts'}).then(accounts => {
        account = accounts[0];
        console.log(account);
        button.textContent = account;

        ethereum.request({method: 'eth_getBalance', params: [account, 'latest']}).then(result => {
            console.log(result);
            let wei = parseInt(result, 16);
            let balance = wei / (10**18);
            console.log(balance + " ETH");
        })
    });

    document.getElementById('send-button').addEventListener('click', event => {
        let transactionParam = {
            to: '0x043CE8D94DA4edA230f4A5a304c5C0e0999CA52E',
            from: account, 
            value: '0x16345785D8A0000'
        };
    
        ethereum.request({method: 'eth_sendTransaction', params:[transactionParam]}).then(txhash => {
            console.log(txhash);
            checkTransactionconfirmation(txhash).then(r => alert(r));
        });
    });
});

function checkTransactionconfirmation(txhash) {

    let checkTransactionLoop = () => {
        return ethereum.request({method:'eth_getTransactionReceipt', params:[txhash]}).then(r => {
            if(r != null) return 'confirmed';
            else return checkTransactionLoop();
        });
    };
    return checkTransactionLoop();
}