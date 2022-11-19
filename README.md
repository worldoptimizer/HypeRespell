# Hype Respell
Playing around with the idea of editing Hype Data Magic Data in the browser.
This is barly a Proof Of Concept. It has no save function or media type specfic interface.
Just putting it here, to archive it and maybe be worked on again in the future.


---

## Ideas, concepts and goals: 

* it’s a single PHP file you drop into your server directory alongside your hype file.
* when accessing the PHP file (either direct link or by making it the index) the first HTML file found or configured is used (configuration option vs. auto detect) and served
* as the PHP is serving the HTML it can edit it and in that step the code for editing is „injected“… hence it doesn’t require any changes to your Hype Project
* there is a tree view of the JS object (the JS object is fetched from HypeDaraMagic or from an object you manually configure)… option for multiple JS objects is on the idea board.
* saving overwrites a specified file with either a JSON version or a home brew(emulation of regular JS notation) stringified version of the data. These options will need a small setup as they are project specific… setting up where you want to save data that is.
* having different edit screens is on the drawing board. Currently only a textfield. File uploads would be really nice, and custom Hype based interfaces (modular) a aspirational goal.
* in general it is agnostic and modular. Meaning it doesn’t rely on Hype Data Magic… that said it will be working very well with it.

## Tree viewer

![CleanShot 2022-05-07 at 14.25.54@2x|690x404](https://forums.tumult.com/uploads/db2156/original/3X/2/8/28730bddc96775e017310f199d9cf16da1f8c322.png)

The reasoning behind a tree view is that not all data can be linked to something seen on stage (metadata, hover states etc.). Also, the base idea is to be agnostic to the usage on stage. That said, in the case of Hype Date Magic, I am planning on magic keys to support an option (like being clicked with a modification key, to not interfere with regular interactions) to open the linked branch.

1. Icons will be type-specific. As data objects are not typed, it will probably be based on guessing based on the key name and/or content. Maybe some declaration, but that would be optional.
2. The data path is gray, and the key name is bigger in black
3. Indentation is based on the hierarchy of the object being viewed
4. The tree viewer is fixed to the right side of the screen and can be scrolled with the mouse or keyboard. Down the line, I'd like a text-based search

## Future ideas …

* robust keyboard navigation
* clicking on Data Magic field should open the edit screen as well
* better text field options
* complete save mechanism

## Visit
https://dev.maxziebell.de/HypeRespell/

## Entering edit mode is done by typing

<kbd>M</kbd> + <kbd>A</kbd> + <kbd>G</kbd> + <kbd>I</kbd> + <kbd>C</kbd>
