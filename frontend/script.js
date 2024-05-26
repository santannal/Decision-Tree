function decisao() {
    const precoCompra = parseFloat(document.getElementById('precoCompra').value);
    const precoVenda = parseFloat(document.getElementById('precoVenda').value);
    const perda = parseFloat(document.getElementById('perda').value) / 100;
    const vendaChuva = parseInt(document.getElementById('vendaChuva').value);
    const vendaSol = parseInt(document.getElementById('vendaSol').value);

    function calcularLucro(kg, precoCompra, precoVenda, perda, vendaChuva, vendaSol) {
        const kgDisponivel = kg - (kg * perda);
        const lucroChuva = (precoVenda * Math.min(kgDisponivel, vendaChuva)) - (precoCompra * kg);
        const lucroSol = (precoVenda * Math.min(kgDisponivel, vendaSol)) - (precoCompra * kg);

        return `Dias de Chuva: R$ ${lucroChuva.toFixed(2)}, Dias Ensolarados: R$ ${lucroSol.toFixed(2)}`;
    }

    const decisao_20kg = calcularLucro(20, precoCompra, precoVenda, perda, vendaChuva, vendaSol);
    const decisao_40kg = calcularLucro(40, precoCompra, precoVenda, perda, vendaChuva, vendaSol);
    const decisao_60kg = calcularLucro(60, precoCompra, precoVenda, perda, vendaChuva, vendaSol);
    const decisao_80kg = calcularLucro(80, precoCompra, precoVenda, perda, vendaChuva, vendaSol);

    document.getElementById('resultado').innerHTML = `
        <p>Decisão para 20kg: ${decisao_20kg}</p>
        <p>Decisão para 40kg: ${decisao_40kg}</p>
        <p>Decisão para 60kg: ${decisao_60kg}</p>
        <p>Decisão para 80kg: ${decisao_80kg}</p>
    `;
}
