const express = require('express');
const app = express();
const port = 3000;

app.use(express.json());

let users = [];

app.post('/register', (req, res) => {
    const { name, email, password } = req.body;
    users.push({ name, email, password });
    res.status(200).send('Регистрация успешна');
});

app.post('/login', (req, res) => {
    const { email, password } = req.body;
    const user = users.find(u => u.email === email && u.password === password);
    if (user) {
        res.status(200).json({ name: user.name });
    } else {
        res.status(401).send('Неверный email или пароль');
    }
});

app.listen(port, () => {
    console.log(`Сервер запущен на порту ${port}`);
});
