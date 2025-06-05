const fs = require('fs');
const path = require('path');
const { marked } = require('marked');

const postsDir = path.join(__dirname, '..', 'site', 'posts');
const files = fs.readdirSync(postsDir).filter(f => f.endsWith('.md')).sort().reverse();

let indexHtml = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsfeed</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Newsfeed</h1>
        <nav><a href="index.html">Back to Home</a></nav>
    </header>
    <main>
`;

for (const file of files) {
    const slug = file.replace(/\.md$/, '');
    const mdPath = path.join(postsDir, file);
    const md = fs.readFileSync(mdPath, 'utf-8');
    const html = marked.parse(md);
    const postHtml = `<!DOCTYPE html>\n<html lang="en">\n<head>\n<meta charset=\"UTF-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n<title>${slug}</title>\n<link rel=\"stylesheet\" href=\"../css/style.css\">\n</head>\n<body>\n<header><h1>${slug}</h1><nav><a href=\"../newsfeed.html\">Back to Newsfeed</a></nav></header>\n<main>${html}</main>\n</body>\n</html>`;
    fs.writeFileSync(path.join(postsDir, `${slug}.html`), postHtml);
    indexHtml += `        <p><a href="posts/${slug}.html">${slug}</a></p>\n`;
}

indexHtml += "    </main>\n</body>\n</html>\n";
fs.writeFileSync(path.join(postsDir, '..', 'newsfeed.html'), indexHtml);
