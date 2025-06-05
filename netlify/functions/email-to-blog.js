const { Buffer } = require('buffer');

exports.handler = async function(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method Not Allowed' };
  }

  let data;
  try {
    data = JSON.parse(event.body);
  } catch (err) {
    return { statusCode: 400, body: 'Invalid JSON body' };
  }

  const subject = data.subject;
  const text = data.text;

  if (!subject || !text) {
    return { statusCode: 400, body: 'Missing subject or text' };
  }

  // simple slug from subject
  const slug = subject
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '');
  const now = new Date();
  const date = now.toISOString().split('T')[0];
  const stamp = now
    .toISOString()
    .split('T')[1]
    .replace(/[:.]/g, '')
    .replace('Z', '');
  const filename = `${date}-${stamp}-${slug}.md`;

  const owner = process.env.GITHUB_OWNER;
  const repo = process.env.GITHUB_REPO;
  const token = process.env.GITHUB_TOKEN;

  if (!owner || !repo || !token) {
    return { statusCode: 500, body: 'GitHub environment variables not configured' };
  }

  const path = `site/posts/${filename}`;
  const content = Buffer.from(text).toString('base64');
  const url = `https://api.github.com/repos/${owner}/${repo}/contents/${path}`;

  const res = await fetch(url, {
    method: 'PUT',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json',
      'User-Agent': 'email-to-blog-script'
    },
    body: JSON.stringify({
      message: `Add post ${filename}`,
      content,
      encoding: 'base64'
    })
  });

  if (!res.ok) {
    const errorText = await res.text();
    return { statusCode: res.status, body: errorText };
  }

  return { statusCode: 200, body: 'Post created' };
};
