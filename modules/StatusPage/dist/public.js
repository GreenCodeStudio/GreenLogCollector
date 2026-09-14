setInterval(async () => {
    const text = await (await fetch(document.location)).text();
    const dom = Document.parseHTMLUnsafe(text)
    document.body.innerHTML = dom.body.innerHTML;
}, 10000);
