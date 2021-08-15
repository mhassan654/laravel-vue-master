export default {
    methods: {
        makeParagraph(obj) {
            return `<p>
            ${obj.data.text}
            </p>`;
        },

        makeImage(obj) {
            const caption = obj.data.caption ? `<div class="">
            <p>${obj.data.caption}</p>
            </div>` : '';
            return `<div class="post-image">
            <a href="single-standard-post.html"><img src="${obj.data.file.url}" alt="${obj.data.caption}"></a>
            ${caption}
          </div>`;
        },

        makeHeader(obj) {
            return `<h${obj.data.level}>${obj.data.text}</h${obj.data.level}>`;
        },

        makeList(obj) {
            if (obj.data.style === 'unordered') {
                const list = obj.data.items.map(item => {
                    return `<li>${item}</li>`;
                });
                return `<ul class="">
                ${list.join('')}
                </ul>`;
            } else {
                const list = obj.data.items.map(item => {
                    return `<li>${item}</li>`;
                });
                return `<ul class="">
                ${list.join('')}
                </ul>`;
            }
        },

        makeQuote(obj) {
            return `<quote>
            ${obj.data.text}
            </quote>`;
        },
    }
}