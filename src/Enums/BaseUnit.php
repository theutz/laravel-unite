<?php

namespace Theutz\Unite\Enums;

enum BaseUnit
{
    // SI
    case Ampere = 'A';
    case Kelvin = 'K';
    case Second = 's';
    case Meter = 'm';
    case Kilogram = 'kg';
    case Candela = 'cd';
    case Mole = 'mol';

    // SI-derived
    case Radian = 'rad';
    case Newton = 'N';
    case Watt = 'W';
    case Volt = 'V';
    case Celsius = 'C';

    // Non-SI accepted for use with SI
    case Minute = 'min';
    case Hour = 'h';
    case Day = 'd';
    case Liter = 'L';
    case Bar = 'bar';
    case MillimeterOfMercury = 'mmHg';

    // US Customary System
    case Inch = 'in';
    case Foot = 'ft';
    case Yard = 'yd';
    case Mile = 'mi';

    case Inch2 = 'in2';
    case Foot2 = 'ft2';
    case Yard2 = 'yd2';
    case Mile2 = 'mi2';
    case Acre = 'acre';

    case Inch3 = 'in3';
    case Foot3 = 'ft3';
    case Yard3 = 'yd3';
    case Mile3 = 'mi3';

    case Teaspoon = 'tsp';
    case Tablespoon = 'tbsp';
    case FluidOunce = 'fl oz';
    case Cup = 'cp';
    case Pint = 'pt';
    case Quart = 'qt';
    case Gallon = 'gal';

    case DryPint = 'dry pt';
    case DryQuart = 'dry qt';
    case DryGallon = 'dry gal';

    case Ounce = 'oz';
    case Pound = 'lb';
    case Ton = 'ton';
    case LongTon = 'long ton';

    // Imperial System
    case Chain = 'ch';
    case Furlong = 'fur';
    case League = 'lea';

    case Perch = 'perch';
    case Rood = 'rood';

    case Gill = 'gil';
    case Stone = 'st';
}
