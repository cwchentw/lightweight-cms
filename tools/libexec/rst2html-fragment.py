#!/usr/bin/env python3
# rst2html-fragment.py - Convert reStructuredText to HTML fragment
#
# Copyright (c) 2022 OpenTechCoder. Licensed under MIT


import sys
from pathlib import Path

from docutils import core


if len(sys.argv) > 1:
    # Read the input file.
    input = Path(sys.argv[1]).read_text()
else:
    # Read the input string from STDIN.
    # Stop STDIN with Ctrl+D.
    input = ""
    for line in sys.stdin:
        input += line

# The settings for docutils.
# We hard-code the settings currently.
#
# TODO: Use a JSON file for settings.
overrides = {
    'initial_header_level': 2,
    'cloak_email_addresses': True,
    'math_output': 'mathjax'}

# Convert the input string to a HTML5 document.
parts = core.publish_parts(
    source=input,
    reader_name='standalone',
    writer_name='html5',
    settings_overrides=overrides)

# Extract the content between the `<body>` tags.
fragment = parts['fragment']

# Print out the result to STDOUT.
print(fragment, end='')
