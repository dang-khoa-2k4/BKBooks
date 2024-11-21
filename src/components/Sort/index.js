

import * as React from 'react';
import Button from '@mui/material/Button';
import Menu from '@mui/material/Menu';
import MenuItem from '@mui/material/MenuItem';

export default function SortButton({Header,Data,setData}) {
  const [anchorEl, setAnchorEl] = React.useState(null);
  const open = Boolean(anchorEl);
  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };
  const handleClose = () => {
    setAnchorEl(null);
  };
  const handleSort = (column) => {
        const sorted = [...Data].sort((a, b) => {
        if (typeof a[column] === "number") {
            return a[column] - b[column];
        } else {
            console.log(a[column])
            return a[column].localeCompare(b[column]);
        }
    });
    setData(sorted);
  }
  return (
    <div>
      <Button
        id="basic-button"
        aria-controls={open ? 'basic-menu' : undefined}
        aria-haspopup="true"
        aria-expanded={open ? 'true' : undefined}
        onClick={handleClick}
      >
        <i class="fa-solid fa-arrow-up-wide-short mr-2"></i>
        <span className="text-gray-500 text-sm">Sort</span>
      </Button>

      <Menu
        id="basic-menu"
        anchorEl={anchorEl}
        open={open}
        onClose={handleClose}
        MenuListProps={{
          'aria-labelledby': 'basic-button',
        }}
      >
        {Header.map((item,index) => (
            <MenuItem key={index} onClick={() => handleSort(item)} sx={{fontSize:"13px"}}>{item}</MenuItem>
        ))}
      </Menu>
    </div>
  );
}
