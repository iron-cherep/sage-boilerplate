module.exports = {
  "root": true,
  "extends": "airbnb",
  "globals": {
    "wp": true
  },
  "env": {
    "node": true,
    "es6": true,
    "amd": true,
    "browser": true,
    "jquery": true
  },
  "rules": {
    "no-console": process.env.NODE_ENV === 'production' ? 2 : 0
  }
}
