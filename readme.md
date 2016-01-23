# KDuma/Comparator
[![Latest Stable Version](https://poser.pugx.org/kduma/comparator/v/stable.svg)](https://packagist.org/packages/kduma/comparator)
[![Total Downloads](https://poser.pugx.org/kduma/comparator/downloads.svg)](https://packagist.org/packages/kduma/comparator)
[![Latest Unstable Version](https://poser.pugx.org/kduma/comparator/v/unstable.svg)](https://packagist.org/packages/kduma/comparator)
[![License](https://poser.pugx.org/kduma/comparator/license.svg)](https://packagist.org/packages/kduma/comparator)

Batch compare multiple files

# Setup
Run bellow command to globally install Comparator:

    composer global require phpunit/phpunit
    
and add `~/.composer/vendor/bin/` directory to your PATH in your ~/.bash_profile (or ~/.bashrc):
	
	export PATH=~/.composer/vendor/bin:$PATH

# Updating
Execute following command:

    composer global update

# Usage

    Usage: bin/compare [-c compare_to, --compare compare_to] [-f format, --format format] [-h, --help] [-o output, --output output] [path] [file]

    Required Arguments:
    	path
    		The path with files to compare.

    Optional Arguments:
    	-h, --help
    		Prints a usage statement
    	-c compare_to, --compare compare_to
    		Compare to
    	-f format, --format format
    		Output format (text or cli)
    	-o output, --output output
    		Output file for text format
    	file
    		If defined, compares specified file in subfolder.

# StringCompare
A special thanks to creators of [StringCompare](https://github.com/akalongman/php-string-compare), a PHP class that this package is using to compare text files.

# Packagist
View this package on Packagist.org: [kduma/comparator](https://packagist.org/packages/kduma/comparator)