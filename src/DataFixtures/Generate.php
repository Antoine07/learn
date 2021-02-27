<?php

namespace App\DataFixtures;


trait Generate {

    public function lorem($nb)
    {

        $wordList = [
            'alias', 'consequatur', 'aut', 'perferendis', 'sit', 'voluptatem',
            'accusantium', 'doloremque', 'aperiam', 'eaque', 'ipsa', 'quae', 'ab',
            'illo', 'inventore', 'veritatis', 'et', 'quasi', 'architecto',
            'beatae', 'vitae', 'dicta', 'sunt', 'explicabo', 'aspernatur', 'aut',
            'odit', 'aut', 'fugit', 'sed', 'quia', 'consequuntur', 'magni',
            'dolores', 'eos', 'qui', 'ratione', 'voluptatem', 'sequi', 'nesciunt',
            'neque', 'dolorem', 'ipsum', 'quia', 'dolor', 'sit', 'amet',
            'consectetur', 'adipisci', 'velit', 'sed', 'quia', 'non', 'numquam',
            'eius', 'modi', 'tempora', 'incidunt', 'ut', 'labore', 'et', 'dolore',
            'magnam', 'aliquam', 'quaerat', 'voluptatem', 'ut', 'enim', 'ad',
            'minima', 'veniam', 'quis', 'nostrum', 'exercitationem', 'ullam',
            'corporis', 'nemo', 'enim', 'ipsam', 'voluptatem', 'quia', 'voluptas',
            'sit', 'suscipit', 'laboriosam', 'nisi', 'ut', 'aliquid', 'ex', 'ea',
            'commodi', 'consequatur', 'quis', 'autem', 'vel', 'eum', 'iure',
            'reprehenderit', 'qui', 'in', 'ea', 'voluptate', 'velit', 'esse',
            'quam', 'nihil', 'molestiae', 'et', 'iusto', 'odio', 'dignissimos',
            'ducimus', 'qui', 'blanditiis', 'praesentium', 'laudantium', 'totam',
            'rem', 'voluptatum', 'deleniti', 'atque', 'corrupti', 'quos',
            'dolores', 'et', 'quas', 'molestias', 'excepturi', 'sint',
            'occaecati', 'cupiditate', 'non', 'provident', 'sed', 'ut',
            'perspiciatis', 'unde', 'omnis', 'iste', 'natus', 'error',
            'similique', 'sunt', 'in', 'culpa', 'qui', 'officia', 'deserunt',
            'mollitia', 'animi', 'id', 'est', 'laborum', 'et', 'dolorum', 'fuga',
            'et', 'harum', 'quidem', 'rerum', 'facilis', 'est', 'et', 'expedita',
            'distinctio', 'nam', 'libero', 'tempore', 'cum', 'soluta', 'nobis',
            'est', 'eligendi', 'optio', 'cumque', 'nihil', 'impedit', 'quo',
            'porro', 'quisquam', 'est', 'qui', 'minus', 'id', 'quod', 'maxime',
            'placeat', 'facere', 'possimus', 'omnis', 'voluptas', 'assumenda',
            'est', 'omnis', 'dolor', 'repellendus', 'temporibus', 'autem',
            'quibusdam', 'et', 'aut', 'consequatur', 'vel', 'illum', 'qui',
            'dolorem', 'eum', 'fugiat', 'quo', 'voluptas', 'nulla', 'pariatur',
            'at', 'vero', 'eos', 'et', 'accusamus', 'officiis', 'debitis', 'aut',
            'rerum', 'necessitatibus', 'saepe', 'eveniet', 'ut', 'et',
            'voluptates', 'repudiandae', 'sint', 'et', 'molestiae', 'non',
            'recusandae', 'itaque', 'earum', 'rerum', 'hic', 'tenetur', 'a',
            'sapiente', 'delectus', 'ut', 'aut', 'reiciendis', 'voluptatibus',
            'maiores', 'doloribus', 'asperiores', 'repellat'
        ];

        $code = [
<<<EOT
```js 
function createStyleObject(classNames, style) {
    return classNames.reduce((styleObject, className) => {
        return {...styleObject, ...style[className]};
    }, {});
}

function createClassNameString(classNames) {
    return classNames.join(' ');
}

// this comment is here to demonstrate an extremely long line length, well beyond what you should probably allow in your own code, though sometimes you'll be highlighting code you can't refactor, which is unfortunate but should be handled gracefully

function createChildren(style, useInlineStyles) {
    let childrenCount = 0;
    return children => {
        childrenCount += 1;
        return children.map((child, i) => createElement({
        node: child,
        style,
        useInlineStyles,
        key:`code-segment-\${childrenCount}-\${i}`
        }));
    }
}
function createElement({ node, style, useInlineStyles, key }) {
    const { properties, type, tagName, value } = node;
    if (type === "text") {
        return value;
    } else if (tagName) {
        const TagName = tagName;
        const childrenCreator = createChildren(style, useInlineStyles);
        const props = (
        useInlineStyles
        ? { style: createStyleObject(properties.className, style) }
        : { className: createClassNameString(properties.className) }
        );
        const children = childrenCreator(node.children);
        return <TagName key={key} {...props}>{children}</TagName>;
    }
}
            ```
EOT,
        ];

        $sentences = [];
        shuffle($wordList);

        for ($i = 0; $i < $nb; $i++) {
            $sentences[] = $wordList[$i];
        }

        return implode(' ', $sentences);
    }
}