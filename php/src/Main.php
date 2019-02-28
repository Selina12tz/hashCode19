<?php
declare(strict_types=1);

namespace App;

function _($a): void
{
    if (true) {
        if (is_array($a)) {
            foreach ($a as $b) {
                echo $b  . "\n";
            }
        } else {
            echo $a  . "\n";
        }
    }
}
class Main
{
    public function __invoke(string $filename)
    {
        $input = new Input($filename);
        $output = new Output();

        $r1 = 0;
        $r2 = $r1 + 1;
        $lastRow = new Row();

        while ($r2 <= $input->getR()) {
            $row = $this->sliceRow($r1, $r2, $input);
            if ($row->getScore() < $lastRow->getScore()) {
                _("adding row");
                $output->addRow($row);

                $r1 = $r2;
                $r2 = $r1 + 1;
                $lastRow = new Row();
            } else {
                $r2++;
                $lastRow = $row;
            }
        }
        if ($lastRow->getScore() != 0) {
            _("adding row");
            $output->addRow($lastRow);
        }

        echo $output;
    }
    private function sliceRow(int $r1, int $r2, Input $input): Row
    {
        $c1 = 0;
        $c2 = $c1 + 1 ;
        $lastSlice = new Slice(0, 0, 0, 0, $input);
        $row = new Row();

        _("Slicing Row $r1, $r2");
        while ($c2 <= $input->getC()) {
            $slice = new Slice($r1, $c1, $r2, $c2, $input);
            _($slice);
            _($slice->getContents());
            if ($slice->isValid($input->getL(), $input->getH())) {
                _('valid');
                if ($slice->getScore() < $lastSlice->getScore()) {
                    _('adding slice');
                    $row->addSlice($slice);
                    $c1 = $c2 + 1;
                    $c2 = $c1 + 1;
                    $lastSlice = new Slice(0, 0, 0, 0, $input);
                } else {
                    $c2++;
                    $lastSlice = $slice;
                }
            } else {
                _('invalid');
                if (!$slice->isValidSize($input->getH())) {
                    _('invalid size');
                    if ($lastSlice->isValid($input->getL(), $input->getH())) {
                        _('adding prev slice');
                        $row->addSlice($lastSlice);
                        $c1 = $c2 - 1;
                        $c2 = $c1 + 1;
                        $lastSlice = new Slice(0, 0, 0, 0, $input);
                    } else {
                        $c1 = $c1 + 1;
                        $c2 = $c1 + 1;
                    }
                } else {
                    _('invalid content');
                    $c2++;
                }
            }
        }
        return $row;
    }
}
